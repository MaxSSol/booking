import { createStore } from "vuex";
import user from "./modules/user";
import search from "./modules/search"
import accommodation from "./modules/accommodation";
import category from "./modules/category";
import facility from "./modules/facility";
import opportunity from "./modules/opportunity";
import star from "./modules/star"

export default createStore({
    modules: {
        user,
        search,
        accommodation,
        category,
        facility,
        opportunity,
        star
    }
})
