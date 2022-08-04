import React, { useState } from 'react';
import styled from 'styled-components';
import { FaBars } from "react-icons/fa";
import { FaDollarSign } from "react-icons/fa";
import { FaHome } from "react-icons/fa";
import {TbGasStation} from "react-icons/tb";
import {GiPokerHand} from "react-icons/gi"
import {GiGamepad} from "react-icons/gi"
import {GiCirclingFish} from "react-icons/gi"
import {GiBasketballBall} from "react-icons/gi"
import {CgCircleci} from "react-icons/cg"
import {IoIosCloseCircleOutline} from "react-icons/io"
import {BsDashCircle} from "react-icons/bs"
import mainlogo from '../../../images/logo/MWCASH_logo.png'
import { Link } from 'react-router-dom';
import Slidebar from './slidebar';
import Pop from '../components/Pop';

const Nav = styled.div`
    height: 155px;
    background:#131b27;
    >nav>div{
        color:#8db4d8;
    }
    .main-logo{
        height: 40px;
    }
    .main-home{
        padding:.25rem;
        border-radius:50%;
    }
    .selectbar{
        color:#fff;
        >a{
            >div{
                background:#333;
                border-radius:50%;
                width:35px;
                height:35px;
                margin:auto;
                svg{
                    font-size:28px;
                }

        }
        }
    }
`
const select = [
    {
        title:"slot",
        icon:<TbGasStation/>,
    },
    {
        title:"live",
        icon:<GiPokerHand/>,
    },
    {
        title:"game",
        icon:<GiGamepad/>,
    },
    {
        title:"fish",
        icon:<GiCirclingFish/>,
    },
    {
        title:"ball",
        icon:<GiBasketballBall/>,
    },
    {
        title:"circle",
        icon:<CgCircleci/>,
    },
]

const Navbar = ({setOpenIframe,openIframe,setMiniIframe,miniIframe}) =>{

    const [openSilder,setOpenSilder] = useState(false);

    const [openPop,setOpenPop] = useState('');

    function CloseMini(){
        setOpenIframe(false);
    }
    function removeItem(){
    }
    return(
        <>
        <Nav className='fixed top-0 left-0 py-2 px-3 w-full z-50'>
            <nav className=' flex items-center justify-between'>
                <div className='flex items-center'>
                    <section className='mr-5'>
                        <p className='text-sm'>demo</p>
                        <p className='text-sm'>ID:mw007</p>
                    </section>
                    <div className='flex items-center text-sm'>
                        <FaDollarSign className='mr-1'/>
                        <p>123,345.00</p>
                    </div>
                </div>
                <div>
                    <FaBars className='text-xl' onClick={()=>setOpenSilder(true)}/>
                    {openIframe == true ?
                    <div className={`flex fixed top-1 right-2 py-2 items-center`}style={{background:"#121b27"}}>
                        <BsDashCircle className='text-2xl' onClick={()=>setMiniIframe(true)}/>
                        <IoIosCloseCircleOutline className={`text-3xl ml-2`} onClick={CloseMini}/>
                    </div>:null}
                </div>
            </nav>
            <div className='flex py-1 items-center justify-center'>
                <Link to="/" className='flex py-1 items-center justify-center'>
                    <img className='main-logo' src={mainlogo}/>
                    <FaHome className='main-home text-2xl text-white bg-main border-main'/>
                </Link>
            </div>
            <div className='grid gap-4 grid-cols-6 selectbar my-2'>
                {select.map((item,key)=>{
                    return(
                        <Link to={item.title} key={key}>
                            <div className='flex items-center justify-center transition active:translate-y-1'>
                                {item.icon}
                            </div>
                        </Link>
                    )
                })}
            </div>
        </Nav>
        <Slidebar setOpenSilder={setOpenSilder} openSilder={openSilder} setOpenPop={setOpenPop}/>
        {openPop !== '' ? <Pop Width="100%" setOpenPop={setOpenPop} openPop={openPop}/> : null}
        </>
    )
}

export default Navbar;
