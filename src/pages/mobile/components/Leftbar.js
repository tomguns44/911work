import React, { useState,useEffect } from 'react';
import styled from 'styled-components';
const Main = styled.div`
    background:#293d56;
    .active{
        background:#fff;
        color:#293d56;
    }
    p{
        font-size:50%;
    }
`
const Leftbar = ({props,setChooseGame,chooseGame}) =>{

    const [getArray,setGetArray] = useState(props);
    const [choose,setChoose] = useState('');



    return(
        <Main className='col-span-2 flex flex-col items-center text-white rounded-b-xl' style={{maxHeight:"270px"}}>
        {getArray.map((item,key)=>{
            return(
                <div key={key} className={`py-4 w-full text-center choose ${chooseGame == `${item.title}` ? "active" : ""}`} onClick={()=>setChooseGame(`${item.title}`)}>
                    <p className='text-sm'>{item.title}</p>
                </div>
            )
        })}
        </Main>
    )
}

export default Leftbar;
