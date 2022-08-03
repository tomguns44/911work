import React, { useState } from 'react';
import JILI from '../../../images/slot/JILI-logo.png'
import FACHAI from '../../../images/slot/FACHAI-logo.png'
import JDB from '../../../images/slot/JDB-logo.png'
import ICONIC from '../../../images/slot/ICONIC-logo.png'
import MW from '../../../images/slot/MWSLOT-logo.png'
import YL from '../../../images/logo/YL.png'
import Topbar from '../components/Topbar';
import Leftbar from '../components/Leftbar';
import Rightbar from '../components/Rightbar';
import {GiCirclingFish} from "react-icons/gi"

const Fish = () =>{
    const [select,setSelect] = useState([
        {
            img:JILI,
            title:"JILI"
        },
        {
            img:FACHAI,
            title:"FACHAI"
        },
        {
            img:JDB,
            title:"JDB"
        },
        {
            img:YL,
            title:"YL"
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
        <Topbar props={select} setChooseGame={setChooseGame} chooseGame={chooseGame} icon={<GiCirclingFish className='text-white'/>}/>


            {chooseGame == '' ? <Rightbar props={gameList}/>:null}
            {chooseGame == 'JILI' ? <Rightbar props={gameList}/>:null}
            {chooseGame == 'FACHAI' ? <Rightbar props={gameList2}/>:null}
            
        </>
    )
}

export default Fish;
