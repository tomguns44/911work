import React, { Component } from 'react';
import {AiFillTool} from 'react-icons/ai'

const Fix =()=>{
    return(
        <div className='absolute w-full h-full top-0 left-0 rounded-lg flex items-center justify-center z-40' style={{background:"rgb(0,0,0,0.7)"}}>
            <AiFillTool className='text-white text-5xl' /> 
        </div>
    )
}

export default Fix;
