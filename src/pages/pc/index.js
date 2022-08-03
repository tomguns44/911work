import React, { useState } from 'react';
import Navbar from './navbar/navbar';
import Carousel from '../mobile/carousel/carousel';
import Carousel1PC from '../../images/carousel/PC/image1.jpeg'
import Carousel2PC from '../../images/carousel/PC/image2.jpeg'
import Carousel3PC from '../../images/carousel/PC/image3.jpeg'
import {HashRouter  as Router, Route, Link,Routes } from "react-router-dom";
import { HashRouter } from 'react-router-dom';
import Home from './home/home';
import Slot from './slot/slot';
import Live from './live/live';
import Sports from './Sports/sports';
import Fish from './fish/fish';
const IndexPC = () =>{

    const [carousel,setCarousel] = useState([
        Carousel1PC,
        Carousel2PC,
        Carousel3PC,
    ]);
    const [moreClick,setMoreClick]=useState('')

    return(
        <>
        <HashRouter>
            <Navbar moreClick={moreClick} setMoreClick={setMoreClick}/>
            <Carousel Height="250px" setCarousel={carousel}/>
            <section className='container mx-auto py-2 px-7' style={{maxWidth:"1440px"}}>
                <Routes>
                    <Route path="/" element={<Home setMoreClick={setMoreClick}/>}/>
                    <Route path="/Slots" element={<Slot limit="10000" moreGame="0"/>}/>
                    <Route path="/Live" element={<Live limit="10000"/>}/>
                    <Route path="/Sports" element={<Sports limit="10000" moreGame="0"/>}/>
                    <Route path="/Fishing" element={<Fish limit="10000" moreGame="0"/>}/>
                </Routes>
            </section>
        </HashRouter>
        </>
    )
}

export default IndexPC;
