import React, { useState,useEffect } from 'react';
import styled from 'styled-components';
import {TbGasStation} from "react-icons/tb";
import {GiPokerHand} from "react-icons/gi"
import {GiGamepad} from "react-icons/gi"
import {GiCirclingFish} from "react-icons/gi"
import {GiBasketballBall} from "react-icons/gi"
import {CgCircleci} from "react-icons/cg"
import { motion } from "framer-motion"


const Mains = styled.div`
    background:#293d56;
    .active{
        background:#fff;
        p{
            color:#293d56;
        }
    }
    svg{
        font-size:28px;
    }
    .logo-img{
        width:30px;
        height:30px;
        object-fit: scale-down;
    }
`

const Topbar = ({props,setChooseGame,chooseGame,icon,title}) =>{

    const [getArray,setGetArray] = useState(props);

    return(
        <Mains className='grid grid-cols-6 gap-4 rounded-t-lg py-1'>
            <div className='flex items-center flex-col justify-center'>
                {icon}
                <p className='text-xs' style={{color:"#ffffff6a"}}>AllGames</p>
            </div>
            {getArray.map((item,key)=>{
                return(
                    <motion.div 
                    initial={{opacity:0,scale:1.5}}
                    animate={{opacity:1,scale:1}}
                    transition={{duration:0.5,delay:`0.${key}`}}
                    className={`flex items-center flex-col justify-center ${chooseGame == `${item.title}` ? "active" : ""}`} 
                    key={key} 
                    onClick={()=>setChooseGame(`${item.title}`)}
                    >
                        <img className='logo-img' src={item.img} />
                        <p className='text-sm text-white'>{item.title}</p>
                    </motion.div>
                )
            })}
        </Mains>
    )
}

export default Topbar;
