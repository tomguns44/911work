import React, { Component } from 'react';

const RowGameTItle = ({icon,title}) =>{
    return(
        <div className='flex items-center title mb-5'>
            <img src={icon}/>
            <p>{title}</p>
        </div>
    )
}

export default RowGameTItle;
