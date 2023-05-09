import ListItemButton from '@mui/material/ListItemButton';
import ListItemText from '@mui/material/ListItemText';
import Checkbox from '@mui/material/Checkbox';
import {ListItem} from "@mui/material";
import List from '@mui/material/List';
import MovieCategoryListRemoveModal from "./MovieCategoryListRemoveModal";

const MovieCategoryList = ({...props}) => {
    return (
        <List
            sx={{
                // width: 200,
                maxWidth: 250,
                position: 'relative',
                overflow: 'auto',
                maxHeight: '50%',
                '& ul': { padding: 0 },
            }}
        >
            {
                props.categories.map((category) => {
                    const labelId = `checkbox-list-secondary-label-${category}`;

                    return (
                        <ListItem
                            key={category.id}
                            secondaryAction={
                                <MovieCategoryListRemoveModal
                                    category={category}
                                    handleRemoveCategory={props.handleRemoveCategory}
                                    fetchCategories={props.fetchCategories}
                                />
                            }
                            disablePadding
                        >
                            <ListItemButton>
                                <Checkbox
                                    edge="end"
                                    onChange={props.handleCategoriesToggle(category)}
                                    checked={props.categoriesChecked.indexOf(category) !== -1}
                                    inputProps={{ 'aria-labelledby': labelId }}
                                />
                                <ListItemText
                                    id={labelId}
                                    primary={category.name}
                                    className="categoryName"
                                />
                            </ListItemButton>
                        </ListItem>
                    )
                })
            }
        </List>
    )
}
export default MovieCategoryList