import React, { useState } from 'react';
import Fix from './Fix';
const RowGame = ({game,limit}) =>{

    const [gamelist,setGamelist] = useState(game)

    return(
        <>
            {gamelist.slice(0,limit).map((item,key)=>{
                return(
                    <li key={key} className="cursor-pointer">
                        <div className='relative'>
                            <img src={item.images}  className="rounded"/>
                            {  item.mask == 1 ?
                                <div className='w-full h-full flex items-center justify-center absolute top-0 left-0 rounded opacity-0 hover:opacity-100 transition duration-300'>
                                    <div className='absolute w-full h-full' style={{background:"rgb(0,0,0,0.7)"}}></div>
                                    <a href="" className='text-black py-2 px-5 rounded relative z-10 hover:text-white' style={{backgroundImage:"linear-gradient(0deg,#855F17 0%,#F3C161 31%,#FFE581 52%,#DEAE53 71%,#A67415 100%)"}}>PLAY NOW</a>
                                </div>
                                :
                                null
                            }
                            {  item.fix == 1 ?
                                <Fix/>
                                :
                                null
                            }

                        </div>
                        <p className='text-center text-xl text-white'>{item.title}</p>
                    </li>
                )
            })}
        </>
    )
}

export default RowGame;
