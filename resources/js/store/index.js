import { createStore } from "vuex";
import user from "./modules/user";
import search from "./modules/search"
import accommodation from "./modules/accommodation";

export default createStore({
    modules: {
        user,
        search,
        accommodation
    }
})
