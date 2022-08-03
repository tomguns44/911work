import React, { useState } from 'react';
import styled from 'styled-components';
import logo from '../../../images/911logo.png'
import Register from './register';
import LoginGame from './loginGame';

const Main = styled.div`

`

const Login = () =>{

    const [open,setOpen] = useState(false)

    return(
    <main className='w-screen h-screen px-10 flex items-center justify-center'>
        <Main className='bg-white w-full rounded-3xl py-8 px-3 flex flex-col'>
            <img className='self-center mb-5' src={logo}/>

            {open == true ? <Register setOpen={setOpen}/> : <LoginGame setOpen={setOpen}/>}
        </Main>
    </main>
    )
}

export default Login;
