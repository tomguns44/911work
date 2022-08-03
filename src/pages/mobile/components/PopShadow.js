import React, { Component } from 'react';
import styled from 'styled-components';


const PopShadow = ({setOpenPop}) =>{
    return(
        <div className='fixed w-full h-full top-0 left-0' style={{background:"rgb(0,0,0,0.6)",zIndex:"100"}} onClick={()=>setOpenPop('')}>        
        </div>
    )
}

export default PopShadow;
