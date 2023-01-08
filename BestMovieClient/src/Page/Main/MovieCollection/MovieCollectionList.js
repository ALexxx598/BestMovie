import List from "@mui/material/List";
import {ListItem} from "@mui/material";
import Checkbox from "@mui/material/Checkbox";
import ListItemButton from "@mui/material/ListItemButton";
import ListItemText from "@mui/material/ListItemText";

const MovieCollectionList = ({...props}) => {
    return (
        <List
            sx={{
                width: 200,
                maxWidth: 200,
                position: 'relative',
                overflow: 'auto',
                maxHeight: '60%',
                '& ul': { padding: 0 },
            }}
        >
            {
                props.collections.map((collection) => {
                    const labelId = `checkbox-list-secondary-label-${collection}`;

                    {
                        console.log(props)
                    }

                    return (
                        <ListItem
                            key={collection.id}
                            secondaryAction={
                                <Checkbox
                                    edge="end"
                                    onChange={props.handleToggle(collection)}
                                    checked={props.checked.indexOf(collection) !== -1}
                                    inputProps={{ 'aria-labelledby': labelId }}
                                />
                            }
                            disablePadding
                        >
                            <ListItemButton>
                                <ListItemText id={labelId} primary={collection.name} />
                            </ListItemButton>
                        </ListItem>
                    )
                })
            }
        </List>
    )
}

export default MovieCollectionList