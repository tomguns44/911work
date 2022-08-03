import React, { Component } from 'react';
import styled from 'styled-components';
import {AiOutlineCloseCircle} from 'react-icons/ai'
import {AiOutlineTransaction} from 'react-icons/ai'
import {BiMessageDetail} from 'react-icons/bi'
import {RiMoneyDollarBoxLine} from 'react-icons/ri'
import {RiLockPasswordLine} from 'react-icons/ri'
import {BiTransferAlt} from 'react-icons/bi'
import {BsFillPeopleFill} from 'react-icons/bs'
import {FiLogOut} from 'react-icons/fi'
import { motion } from 'framer-motion';

const Main = styled.div`
    svg{
        font-size: 1.25rem;
        line-height: 1.75rem;
        margin-right:.5rem;
    }
`
const variants ={
    open:{x:"0%",width:"48%",opacity:1},
    close:{x:"100%",width:"48%",opacity:0},
}

const slider = [
    {
        title:"Transaction Report",
        icon:<AiOutlineTransaction/>
    },
    {
        title:"Messages",
        icon:<BiMessageDetail/>
    },
    {
        title:"Member Info",
        icon:<BsFillPeopleFill/>
    },
    {
        title:"Fund In/Out",
        icon:<RiMoneyDollarBoxLine/>
    },
    {
        title:"Reset Password",
        icon:<RiLockPasswordLine/>
    },
    {
        title:"Outstanding",
        icon:<BiTransferAlt/>
    },
    {
        title:"LOGOUT",
        icon:<FiLogOut/>
    },

]


const Slidebar = ({setOpenSilder,openSilder,setOpenPop}) =>{
    return(
        <motion.div
         animate={openSilder == true ? "open":"close"}
         variants={variants}
         className={`fixed h-full z-50 right-0 top-0 ${openSilder == false ? "!hidden" : "!block"}`}
         style={{background:"#131b27",}}
        >
            <Main className='h-full py-5 px-3 flex flex-col'>
                <AiOutlineCloseCircle className='self-end text-white text-3xl' onClick={()=>setOpenSilder(openSilder=>!openSilder)}/>
                <ul className='flex flex-col items-center mt-8'>
                    {
                        slider.map((item,key)=>{
                            return(
                                <li key={key} className='p-2 mb-3 text-white text-sm flex items-center w-full' onClick={()=>setOpenPop(`${item.title}`)}>{item.icon}{item.title}</li>
                            )
                        })
                    }
                </ul>
            </Main>
        </motion.div>
    )
}

export default Slidebar;
