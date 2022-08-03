import { configureStore } from "@reduxjs/toolkit";
import counterReducer from '../../pages/redux/counterSlice'


export const store = configureStore({
    reducer:{
        select :counterReducer,
    }
})