import React, { Component } from 'react';
import sportsIcon from '../../../images/gameType/icon-sports.svg'
import RowGameTItle from '../../mobile/components/rowGameTItle';
import RowGame from '../../mobile/components/rowGame';
import styled from 'styled-components';
import images1 from '../../../images/gameIcon/en/SPORTS/sports_wos.png'
import { motion } from 'framer-motion';


const Section = styled.div`
    .title{
        color:#f4e0bd;
        *{
            font-size:25px;
        }
    }
`

const game=[
    {
        images:images1,
        href:''
    },
    {
        images:images1,
        href:''
    },
    {
        images:images1,
        href:''
    },
    {
        images:images1,
        href:''
    },
    {
        images:images1,
        href:''
    }
]

const Sports = ({limit}) =>{
    return(
        <>
        <motion.section
        initial={{opacity:0}}
        animate={{opacity:1}}
        transition={{duration:.3}}
        >
            <Section className="flex flex-col mb-6">
                <RowGameTItle icon={sportsIcon} title="Sports"/>
                <ul className='grid grid-cols-4 gap-4 w-full'>
                    <RowGame game={game} limit={limit}/>
                </ul>
            </Section>
        </motion.section>
        </>
    )
}

export default Sports;
