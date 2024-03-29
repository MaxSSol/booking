import { createStore } from "vuex";
import user from "./modules/user";
import search from "./modules/search"
import accommodation from "./modules/accommodation";
import category from "./modules/category";
import facility from "./modules/facility";
import opportunity from "./modules/opportunity";
import star from "./modules/star"
import accommodationUnit from "./modules/accommodationUnit";
import reservation from "./modules/reservation";
import rentHistory from "./modules/rentHistory";
import paymentMethod from "./modules/paymentMethod"
import quest from "./modules/quest";
import rentInfo from "./modules/rentInfo";
import city from "./modules/city";
import owner from "./modules/owner";
import accommodationComment from "./modules/accommodationComment";

export default createStore({
    modules: {
        user,
        search,
        accommodation,
        category,
        facility,
        opportunity,
        star,
        accommodationUnit,
        reservation,
        rentHistory,
        paymentMethod,
        quest,
        rentInfo,
        city,
        owner,
        accommodationComment
    }
})
