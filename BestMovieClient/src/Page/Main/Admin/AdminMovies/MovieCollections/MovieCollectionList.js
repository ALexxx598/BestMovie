import List from "@mui/material/List";
import {IconButton, ListItem, ListItemIcon} from "@mui/material";
import Checkbox from "@mui/material/Checkbox";
import ListItemButton from "@mui/material/ListItemButton";
import ListItemText from "@mui/material/ListItemText";
import './movieCollectionList.css'
import MovieCollectionListRemoveModal from "./MovieCollectionListRemoveModal";

const MovieCollectionList = ({...props}) => {
    return (
        <List
            sx={{
                // width: 200,
                maxWidth: 250,
                position: 'relative',
                overflow: 'auto',
                maxHeight: props?.height ?? '60%',
                '& ul': { padding: 0 },
            }}
        >
            {
                props.collections.map((collection) => {
                    const labelId = `checkbox-list-secondary-label-${collection}`;

                    return (
                        <ListItem
                            key={collection.id}
                            secondaryAction={
                                <MovieCollectionListRemoveModal
                                    collection={collection}
                                    handleRemoveCollection={props.handleRemoveCollection}
                                    fetchDefaultCollections={props.fetchDefaultCollections}
                                />
                            }
                            disablePadding
                        >
                            <ListItemButton>
                                <Checkbox
                                    edge="end"
                                    onChange={props.handleToggle(collection)}
                                    checked={props.collectionChecked.indexOf(collection) !== -1}
                                    inputProps={{ 'aria-labelledby': labelId }}
                                />
                                <ListItemText
                                    id={labelId}
                                    primary={collection.name}
                                    multiline
                                    className="collectionName"
                                />
                            </ListItemButton>
                        </ListItem>
                    )
                })
            }
        </List>
    )
}

export default MovieCollectionList