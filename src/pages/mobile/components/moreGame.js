import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import {MdKeyboardArrowRight} from 'react-icons/md'

const MoreGame = ({link,setMoreClick}) =>{
    return(
        <Link to={`/${link}`} className='flex self-end' onClick={()=>setMoreClick(link)}>
            <div className='flex mt-10'>
                <div className='flex items-center text-xl py-2 px-4 text-amber-400' style={{backgroundImage:"linear-gradient(-180deg,#575757 0%,#0F0F0F 100%)"}}>
                    <p>More Game</p> 
                    <MdKeyboardArrowRight/>
                </div>
            </div>
        </Link>
    )
}

export default MoreGame;
