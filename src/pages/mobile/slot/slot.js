import React, { useState,useEffect } from 'react';
import styled from 'styled-components';
import JILI from '../../../images/slot/JILI-logo.png'
import FACHAI from '../../../images/slot/FACHAI-logo.png'
import JDB from '../../../images/slot/JDB-logo.png'
import AWS from '../../../images/logo/AE.png'
import FASTSPIN from '../../../images/logo/FASTSPIN.png'
import {TbGasStation} from "react-icons/tb";
import Topbar from '../components/Topbar';
import Leftbar from '../components/Leftbar';
import Rightbar from '../components/Rightbar';



const Slot = () =>{

    const [select,setSelect] = useState([
        // {
        //     img:JILI,
        //     title:"JILI"
        // },
        {
            img:FACHAI,
            title:"FACHAI"
        },
        // {
        //     img:JDB,
        //     title:"JDB"
        // },
        {
            img:AWS,
            title:"AWS"
        },
        {
            img:FASTSPIN,
            title:"FASTSPIN"
        },
    ])
    

    const [leftbar,setLeftbar] = useState([
        {
            title:"MIMI",
        },
        {
            title:"One Game",
        },
        {
            title:"YB",
        },
        {
            title:"PlayStar",
        },
        {
            title:"AE SLOT",
        },
    ])

    const [gameList,setGameList] = useState([
        {
            img:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/CRAZY_CANDY.webp",
            title:"Crazy Candy",
            fix:1
        },
        {
            img:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/CRAZY_CANDY.webp",
            title:"Crazy Candy",
            fix:1
        },
        {
            img:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/CRAZY_CANDY.webp",
            title:"Crazy Candy",
            fix:1
        },
        {
            img:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/CRAZY_CANDY.webp",
            title:"Crazy Candy",
            fix:1
        },
        {
            img:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/CRAZY_CANDY.webp",
            title:"Crazy Candy",
            fix:1
        },
        {
            img:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/CRAZY_CANDY.webp",
            title:"Crazy Candy",
            fix:1
        },
        {
            img:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/CRAZY_CANDY.webp",
            title:"Crazy Candy",
            fix:1
        },
        {
            img:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/CRAZY_CANDY.webp",
            title:"Crazy Candy",
            fix:1
        },
        {
            img:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/CRAZY_CANDY.webp",
            title:"Crazy Candy",
            fix:1
        },
        {
            img:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/CRAZY_CANDY.webp",
            title:"Crazy Candy",
            fix:1
        },
    ])

    const [gameList2,setGameList2] = useState([
        {
            img:"https://www.mwbet188.com/theme/images/gameIcon/JILI/SuperAce.webp",
            title:"Super Ace",
            fix:0
        },
    ])

    const [chooseGame,setChooseGame] = useState('')

    return(
        <>
        <Topbar props={select} setChooseGame={setChooseGame} chooseGame={chooseGame} icon={<TbGasStation className='text-white'/>}/>
        {/* <section className='grid grid-cols-12'> */}

            {/* <Leftbar props={leftbar} setChooseGame={setChooseGame} chooseGame={chooseGame}/> */}

            {chooseGame == '' ? <Rightbar props={gameList}/>:null}
            {chooseGame == 'MIMI' ? <Rightbar props={gameList}/>:null}
            {chooseGame == 'One Game' ? <Rightbar props={gameList2}/>:null}
            
        {/* </section> */}
        </>
    )
}

export default Slot;
