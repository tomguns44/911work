import React, { Component } from 'react';
import styled from 'styled-components';
import {AiOutlineFullscreen} from 'react-icons/ai'

const Main = styled.div`
    >div{
        background-image: linear-gradient(-180deg,#2D465F 16%,#142531 48%,#0B1720 49%,#132A3C 85%,#162F42 91%,#1E3F59 92%,#0C171F 100%);
        border: 2px solid #6796b9;
    }
    img{
        width:35px;
        border-radius:5px;
        margin-right:.5rem;
    }
    p,svg{
        color:#e2cc9c;
    }
`

const MiniIframe = ({setMiniIframe,iframeContent}) =>{
    return(
        <Main id="mini" className='fixed bottom-12 flex items-center px-2 py-1 w-full active:translate-y-1 transition duration-300' style={{height:"55px",zIndex:"55"}}>
            <div className='w-full h-full rounded-xl border-2 py-1 px-4 flex items-center justify-between' onClick={()=>setMiniIframe(false)}>
                <div className='flex items-center'>
                    <img src={iframeContent.image} />
                    <p className=''>{iframeContent.title}</p>
                </div>
                <AiOutlineFullscreen className='text-3xl'/>
            </div>
        </Main>
    )
}

export default MiniIframe;
