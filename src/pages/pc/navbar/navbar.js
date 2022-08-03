import React, { useState } from 'react';
import { FiUser } from 'react-icons/fi';
import { FaDollarSign } from 'react-icons/fa';
import styled from 'styled-components';
import { GiHamburgerMenu } from 'react-icons/gi';
import EN from '../../../images/language/EN.png'
import MWlogo from '../../../images/logo/MWCASH_logo.png'
import navBg from '../../../images/navbarBG/nav-bg02.png'
import slotIcon from '../../../images/gameType/icon-slot.svg'
import homeIcon from '../../../images/gameType/icon-home.svg'
import arcadeIcon from '../../../images/gameType/icon-arcade.svg'
import liveIcon from '../../../images/gameType/icon-live.svg'
import fishIcon from '../../../images/gameType/icon-fish.svg'
import sportsIcon from '../../../images/gameType/icon-sports.svg'
import rngtableIcon from '../../../images/gameType/icon-rngtable.svg'
import { Link } from 'react-router-dom';

import {useSelector,useDispatch} from 'react-redux';
import {select} from '../../redux/counterSlice'


const Header = styled.div`
    background-image:linear-gradient(-180deg,#0C1117 0%,#162C3F 100%);
    color:#f4e0bd;
    header{
        background: url(${navBg}),linear-gradient(-180deg,#2D465F 16%,#142531 48%,#0B1720 49%,#132A3C 85%,#162F42 91%,#1E3F59 92%,#0C171F 100%);
        background-position: right;
        background-repeat: no-repeat,no-repeat;
        background-blend-mode: lighten,normal;
    }
    .selector{
        li:hover{    
            background-image: linear-gradient(-180deg,#C2A056 16%,#625424 47%,#45391A 49%,#0A161F 91%,#162E41 92%,#0C171F 100%);
            cursor:pointer;
        }
    }
    .select{
        background-image: linear-gradient(-180deg,#C2A056 16%,#625424 47%,#45391A 49%,#0A161F 91%,#162E41 92%,#0C171F 100%);
        cursor:pointer;
    }
`
const gameType = [
    {
        icon:homeIcon,
        title:"Home",
        link:""
    },
    {
        icon:slotIcon,
        title:"Slots",
        link:"Slots"
    },
    {
        icon:liveIcon,
        title:"Live",
        link:"Live"
    },
    {
        icon:arcadeIcon,
        title:"Arcade",
        link:"Arcade"
    },
    {
        icon:fishIcon,
        title:"Fishing",
        link:"Fishing"
    },
    {
        icon:sportsIcon,
        title:"Sports",
        link:"Sports"
    },
    {
        icon:rngtableIcon,
        title:"Table",
        link:"Table"
    },
]

const Navbar = ({moreClick,setMoreClick}) =>{


    return(
        <Header className='fixed top-0 left-0 w-full z-50'>
            <nav className='flex items-center justify-between p-3 container mx-auto'>
                <div className='flex items-center'>
                    <FiUser className='text-2xl mr-5'/>
                    <div className='flex items-start flex-col mr-5'>
                        <p>demo</p>
                        <p>ID:mw007</p>
                    </div>
                    <div className='flex items-center text-xl'>
                        <FaDollarSign className='mr-1'/>
                        <p>123,345.00</p>
                    </div>
                </div> 
                <div className='flex items-center'>
                    <div className='p-3 flex items-center mr-5'>
                        <p className='mr-2'>EN</p>
                        <img src={EN} style={{width:"30px"}}/>
                    </div>
                    <GiHamburgerMenu className='text-3xl cursor-pointer'/>
                </div>
            </nav>   
            <header className=''>
                <section className='container mx-auto flex items-center'>
                    <img src={MWlogo} style={{width:"136px"}} className="px-3"/>
                    <ul className='flex items-center selector'>
                        {
                            gameType.map((item,key)=>{
                                return(
                                    <Link to={item.link}>
                                        <li className={`flex flex-col items-center py-4 px-7 transition duration-300 ${moreClick == item.title ? 'select' : null}`} key={key} onClick={()=>setMoreClick(item.title)}>
                                            <img src={item.icon}/>
                                            <p>{item.title}</p>
                                        </li>
                                    </Link>
                                )
                            })
                        }
                    </ul>
                </section>
            </header>
        </Header>
    )
}

export default Navbar;
