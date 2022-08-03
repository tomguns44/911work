import React, { Component } from 'react';
import styled from 'styled-components';
import liveIcon from '../../../images/gameType/icon-live.svg'
import images1 from '../../../images/gameIcon/en/SEXYBCRT/promote_sexybaccarat.png'
import RowGame from '../../mobile/components/rowGame';
import RowGameTItle from '../../mobile/components/rowGameTItle';
import { motion } from 'framer-motion';

const Section = styled.div`
    .title{
        color:#f4e0bd;
        *{
            font-size:25px;
        }
    }
    >ul{
        >li:nth-child(1){
            grid-row: span 2 / span 2;
            grid-column: span 2 / span 2;
        }
    }
`
const game = [
    {
        images:images1,
        href:''
    },
    {
        images:images1,
        href:''
    },
]


const Live = ({limit}) =>{
    return(
        <>
        <motion.Section
        initial={{opacity:0}}
        animate={{opacity:1}}
        transition={{duration:.3}}
        >
            <Section className="flex flex-col mb-6">
                <RowGameTItle icon={liveIcon} title="Live"/>
                <ul className='grid grid-cols-4 gap-4 w-full'>
                    <RowGame game={game} limit={limit}/>
                </ul>
            </Section>
        </motion.Section>
        </>
    )
}

export default Live;
