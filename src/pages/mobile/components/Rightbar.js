import React, { useState,useEffect } from 'react';
import styled from 'styled-components';
import {AiOutlineBars} from 'react-icons/ai'
import RightbarGamelist from './RightbatGamelist';


const Main = styled.div`
    // background-image: linear-gradient(-180deg,#142638 0%,#3c5272 100%);
    svg{
        color:#e1be83;
    }
    img{
        border-radius:10px;
    }
    .Parallel{
        grid-template-columns: repeat(1, minmax(0, 1fr));
        >div{
            display: flex;
            width: 100%;
            background: #131d2b;
            align-items: center;
            padding:.5rem;
            border-radius:10px;
            >img{
                width:80px;
                margin-right:.75rem;
            }
            >p{
                font-size:100%;
            }
        }
    }
`


const Rightbar = ({props}) =>{

    const [giveClass,setGiveClass] = useState(false)


    return(
        <Main className='col-span-10 p-3 flex flex-col'>
            <AiOutlineBars className='self-end text-2xl' onClick={()=>setGiveClass(!giveClass)}/>
            <RightbarGamelist props={props} giveClass={giveClass}/>
        </Main>

    )
}

export default Rightbar;
