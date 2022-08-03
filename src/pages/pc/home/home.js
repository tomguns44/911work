import React, { Component } from 'react';
import styled from 'styled-components';
import Live from '../live/live';
import Sports from '../Sports/sports';
import Slot from '../slot/slot';
import Newgame from '../newgame/newgame';
import Fish from '../fish/fish';
const Header = styled.div`
    max-width:1440px;
`

const Home = ({setMore,setMoreClick}) =>{
    return(
        <>
        <Header>
            <Live />
            <Sports/>
            <Slot limit="14" moreGame="1" setMoreClick={setMoreClick} link="Slots"/>
            <Newgame limit="14" moreGame="1" setMoreClick={setMoreClick} link="Slots"/>
            <Fish limit="7" moreGame="1" setMoreClick={setMoreClick} link="Fishing"/>
        </Header>
        </>
    )
}

export default Home;
