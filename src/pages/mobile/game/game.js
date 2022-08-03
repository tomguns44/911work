import React, { useState } from 'react';
import JILI from '../../../images/slot/JILI-logo.png'
import FACHAI from '../../../images/slot/FACHAI-logo.png'
import JDB from '../../../images/slot/JDB-logo.png'
import YL from '../../../images/logo/YL.png'
import AE from '../../../images/logo/AE.png'
import Topbar from '../components/Topbar';
import Leftbar from '../components/Leftbar';
import Rightbar from '../components/Rightbar';
import {GiGamepad} from "react-icons/gi"


const Game = () =>{

    const [select,setSelect] = useState([
        {
            img:AE,
            title:"AE"
        },
        {
            img:FACHAI,
            title:"FACHAI"
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
        <Topbar props={select} setChooseGame={setChooseGame} chooseGame={chooseGame} icon={<GiGamepad className='text-white'/>}/>
        <section className='grid grid-cols-12'>

            <Leftbar props={leftbar} setChooseGame={setChooseGame} chooseGame={chooseGame}/>

            {chooseGame == '' ? <Rightbar props={gameList2}/>:null}
            {chooseGame == 'MIMI' ? <Rightbar props={gameList2}/>:null}
            {chooseGame == 'One Game' ? <Rightbar props={gameList}/>:null}
            
        </section>
        </>
    )
}

export default Game;
