import React, { useState } from 'react';
import Rightbar from '../components/Rightbar';
import AE from '../../../images/logo/AE.png'
import SEXYBCRT from '../../../images/logo/SEXYBCRT.png'
import VENUS from '../../../images/logo/VENUS.png'
import {GiPokerHand} from "react-icons/gi"
import Topbar from '../components/Topbar';



const Live = () =>{
    const [gameList,setGameList] = useState([
        {
            img:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/CRAZY_CANDY.webp",
            title:"Crazy Candy",
            fix:1
        },
    ])    
    const [select,setSelect] = useState([
        // {
        //     img:JILI,
        //     title:"JILI"
        // },
        {
            img:AE,
            title:"AE"
        },
        // {
        //     img:JDB,
        //     title:"JDB"
        // },
        {
            img:SEXYBCRT,
            title:"SEXY"
        },
        {
            img:VENUS,
            title:"VENUS"
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
            <Topbar props={select} setChooseGame={setChooseGame} chooseGame={chooseGame} icon={<GiPokerHand className='text-white'/>}/>
            <Rightbar props={gameList} />
        </>
    )
}

export default Live;
