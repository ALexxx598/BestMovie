import {useEffect, useState} from "react";
import {useFormik} from "formik";

import {useAuth} from "../../../../../hooks/useAuth";

import StorageApiService from "../../../../../Api/Storage/StorageApiService";
import MovieApiService from "../../../../../Api/Movie/MovieApiService";

import * as Yup from "yup";

import useCollections from "../../../../../hooks/useCollections";

const newMovieSchema = Yup.object().shape({
    name: Yup.string()
        .min(2, 'Too Short!')
        .max(50, 'Too Long!')
        .required('This field is required'),
    rating: Yup.string()
        .min(2, 'Too Short!')
        .max(50, 'Too Long!'),
    slogan: Yup.string()
        .min(2, 'Too Short!')
        .max(50, 'Too Long!'),
    screeningDate: Yup.string(), //TODO date validation
    country: Yup.string()
        .min(2, 'Too Short!')
        .max(50, 'Too Long!'),
    actors: Yup.string()
        .min(2, 'Too Short!'),
    shortDescription: Yup.string()
        .min(2, 'Too Short!'),
});

const FILE_SIZE = 1024 * 1024;
const SUPPORTED_FORMATS = [
    "image/jpg",
    "image/jpeg",
    "image/png"
];

const useMovieAddModal = ({...props}) => {
    const { auth } = useAuth()

    const [show, setShow] = useState(false);

    const handleClose = async () => {
        setShow(false);
        await fetchDefaultCollections()
    }
    const handleShow = async () => {
        await fetchDefaultCollections()
        setShow(true);
    }

    const { collectionChecked, handleToggle, collections, fetchDefaultCollections, getCollectionIds } = useCollections()

    const [image, setImage] = useState(null)
    const [video, setVideo] = useState(null)

    const handleSaveChanges = async (values) => {
        try {
            let data = new FormData()
            data.append('media', image)
            data.append('user_id', auth?.id)
            const moviePosterLink = await StorageApiService.uploadImage(auth?.accessToken, data)

            data = new FormData()
            data.append('media', video)
            data.append('user_id', auth?.id)
            const movieVideoLink = await StorageApiService.uploadMovie(auth?.accessToken, data)

            const movieResponse = await MovieApiService.create(
                auth,
                values.name,
                values.rating,
                values.slogan,
                values.screeningDate,
                values.country,
                values.actors,
                values.shortDescription,
                // '/movie/video/202303101234148086732713.mp4',
                movieVideoLink,
                moviePosterLink,
                // '/movie/video/202303101234148086732713.mp4',
                // '/movie/images/2023031020721498df01bc50.png',
            )

            await MovieApiService.saveDefaultCollections(getCollectionIds(), movieResponse.movie.id, auth)
        } catch (error) {
            console.log('error formik' + error)
        } finally {
            await props.fetchMovies()
        }
    }

    const formik = useFormik({
        initialValues: {
            'name': '',
            'rating': '',
            'slogan': '',
            'screeningDate': '',
            'country': '',
            'actors': '',
            'shortDescription': '',
        },
        onSubmit: values => {
            handleSaveChanges(values)
        },
        validationSchema: newMovieSchema
    })

    useEffect(() => {
        fetchDefaultCollections()
    }, [])

    return {
        collections,
        handleToggle,
        collectionChecked,
        show,
        handleShow,
        handleClose,
        formik,
        setImage,
        setVideo
    }
}

export default useMovieAddModal