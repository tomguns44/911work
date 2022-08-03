import React, { useState,useEffect } from 'react';
import gameImg1 from '../../../images/home/game-list1/game/BingoCarnaval.webp'
import gameImg2 from '../../../images/home/game-list1/game/ChineseNewYear2.webp'
import gameImg3 from '../../../images/home/game-list1/game/GoldRush.webp'
import gameImg4 from '../../../images/home/game-list1/game/HappyTaxi.webp'
import gameImg5 from '../../../images/home/game-list1/game/MayanEmpire.webp'
import gameImg6 from '../../../images/home/game-list1/game/SicBo.webp'
import Fix from '../components/Fix';

const Game = ({props,openGame,setIframeContent}) =>{
    const [getimages,setGetimages] = useState(props);

    const [windowGame,setWindowGame] = useState([])
    
    function test(name,key){
        setIframeContent(getimages[key])
        openGame(true);
    }
    
        return(
        <>
        {getimages.map((item,key)=>{
            return(    
                    <li className='flex flex-col items-center gamelist p-2 relative' id={item.title} key={key} onClick={()=>test(item.title,key)}>
                        <a className='flex flex-col items-center' href="#">
                            <img src={item.image} style={{height:"94px"}}/>
                            <p className='text-sm type font-light'>{item.type}</p>
                            <p className='title text-center'>{item.title}</p>
                        </a>
                        {item.fix == 1 ?<Fix/> : null}
                    </li>
            )
        })}
        </>
    )
}

export default Game;
