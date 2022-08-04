import React from 'react';
import styled from 'styled-components';
import {AiOutlineTransaction} from 'react-icons/ai'
import {BiMessageDetail} from 'react-icons/bi'
import {RiMoneyDollarBoxLine} from 'react-icons/ri'
import {RiLockPasswordLine} from 'react-icons/ri'
import {BiTransferAlt} from 'react-icons/bi'
import {BsFillPeopleFill} from 'react-icons/bs'
import {FiLogOut} from 'react-icons/fi'



const Ham = styled.div`
    position:absolute;
    background-image: linear-gradient(-180deg,#0C1117 0%,#162C3F 100%);
    
    li:hover{
        *{
            filter: glow(color:blue, strength=2); 
            text-shadow: 1px 1px 11px #f4e0bd;
            }
    }

`
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
const Hamburger = ({setOpenPop,setOpenHam}) => {
    return (
        <Ham className='right-0'>
            <ul className='py-2 px-5' style={{width:"250px"}}>
                {slider.map((item,key)=>{
                    return(
                        <li className='flex items-center my-4 text-xl cursor-pointer' onClick={()=>setOpenPop(item.title)}>
                            {item.icon}
                            <p className='ml-4'>{item.title}</p>
                        </li>
                    )
                })}
            </ul>
        </Ham>
    );
}

export default Hamburger;
