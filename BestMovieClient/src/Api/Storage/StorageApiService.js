import axios from '../StorageMovieAxios'

export default class StorageApiService {
    static UPLOAD = '/api/media-uploader/';

    static async uploadMovie(accessToken, data) {
        data.append('media_type', 'MOVIE_VIDEO')

        const response = await axios.post(
            this.UPLOAD,
            data,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                    'Authorization': accessToken
                }
            }
        )

        return response.data.data.url;
    }

    static async uploadImage(accessToken, data) {
        data.append('media_type', 'MOVIE_IMAGE')

        const response = await axios.post(
            this.UPLOAD,
            data,
            {
                headers: {
                    "Content-Type": "multipart/form-data",
                    'Authorization': accessToken
                }
            }
        )

        return response.data.data.url;
    }
}