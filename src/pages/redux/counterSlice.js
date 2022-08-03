import { createSlice } from '@reduxjs/toolkit';

const initialState = {
    title:0,
}

export const counterSlice = createSlice({
    name:'counter',
    initialState,
    reducers:{
        select:(state)=>{
            state.title = this.state.title
            console.log(state.title)
        }
    }
});

export const {select} = counterSlice.actions;

export default counterSlice.reducer