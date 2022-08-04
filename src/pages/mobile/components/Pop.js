import React, { Component } from 'react';
import PopShadow from './PopShadow';
import styled from 'styled-components';
import {AiOutlineCloseCircle} from 'react-icons/ai'
import { motion } from 'framer-motion';

import MemberDetail from '../member/PopContent/MemberDetail';
import Resetpassword from '../member/PopContent/Resetpassword';

const Main = styled.div`
    main{
        height:500px;
    }
`

const Pop = ({setOpenPop,openPop,Width}) =>{
    return(
        <>
        <motion.section
        initial={{opacity:0}}
        animate={{opacity:1}}
        transition={{duration:.2}}
        className="relative"
        style={{zIndex:"60"}}
        >
            <Main className='flex items-center justify-center px-5 w-screen h-screen fixed top-0 left-0' style={{zIndex:"60"}}>
                <PopShadow setOpenPop={setOpenPop}/>
                <main className='bg-white relative rounded-3xl flex flex-col py-4 px-5 ' style={{zIndex:"200",width:Width}}>
                    <AiOutlineCloseCircle className='self-end text-3xl mb-5 hover:scale-110 cursor-pointer transition duration-300' onClick={()=>setOpenPop('')}/>
                    {openPop == 'Member Info' ? <MemberDetail/> : null}
                    {openPop == 'Reset Password' ? <Resetpassword/> : null}
                </main>
            </Main>
        </motion.section>
        </>
    )
}

export default Pop;
