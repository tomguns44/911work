import React, { useState } from 'react';
import styled from 'styled-components';
import Gamelist1bg from '../../../images/home/game-list1/section-NEW-bg.jpeg'
import {AiOutlineStar} from "react-icons/ai";
import Game from './Game';

const Gamelist = styled.div`
    padding:.5rem;
    >main{
        border-radius:10px;
        background-size: cover;
        >div{
            svg{
                font-size:24px;
                margin-right:.25rem;
            }
        }
        >section{
            >ul{
                grid-template-columns: repeat(18,110px);
                display:grid;
                
                .gamelist{
                    .type{
                        color:#b4c1e9;
                        font-size:65%;  
                    }
                    .title{
                        font-size:75%;
                        color:#b4c1e9;
                    }
                }
            }
        }
    }
`

const GameList = ({props,title,titleIcon,background,openGame,setIframeContent}) =>{

    const [List , setList]  = useState([]);



    return(
        <>
        <Gamelist>
            <main className='flex flex-col justify-center items-center' style={{background:`url(${background})`}}>
                <div className='flex text-white items-center py-2'>
                    {titleIcon}
                    <p>{title}</p>
                </div>
                <section className='py-2 px-4 w-full'>
                    <ul className='w-full overflow-scroll'>
                        <Game props={props} openGame={openGame} setIframeContent={setIframeContent}/>
                    </ul>
                </section>
            </main>
        </Gamelist>
        </>
    )
}

export default GameList;
