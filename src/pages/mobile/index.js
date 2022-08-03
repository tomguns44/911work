import React, { useState } from 'react';
import Navbar from './navbar/navbar';
import Carousel from './carousel/carousel';
import Home from './home/Home';
import Slot from './slot/slot';
import Live from './live/live';
import Game from './game/game';
import Fish from './fish/fish';
import Ball from './ball/ball';
import Circle from './circle/circle';
import Iframe from './components/Iframe';
// import {BrowserRouter as Router,Switch,Routes,Route,Link, BrowserRouter} from "react-router-dom";
import {HashRouter  as Router, Route, Link,Routes } from "react-router-dom";
import { HashRouter } from 'react-router-dom';
import MiniIframe from './components/MiniIframe';
import Carousel1 from '../../images/carousel/image1.jpeg'
import Carousel2 from '../../images/carousel/image2.jpeg'
import Carousel3 from '../../images/carousel/image3.jpeg'



const Index = () =>{
    
    const [openIframe,setOpenIframe] = useState(false);

    const [miniIframe,setMiniIframe] = useState(false);

    const [iframeContent,setIframeContent] = useState([]);

    const [carousel,setCarousel] = useState([
        Carousel1,
        Carousel2,
        Carousel3,
    ])

    return(
        <>
        <HashRouter>
        <Navbar setOpenIframe={setOpenIframe} openIframe={openIframe} setMiniIframe={setMiniIframe} miniIframe={miniIframe}/>
        <Carousel setCarousel={carousel} Height="110px"/>
            <Routes>
                <Route path="/" element={<Home setOpenIframe={setOpenIframe} setIframeContent={setIframeContent}/>}/>
                <Route path="/slot" element={<Slot setOpenIframe={setOpenIframe} setIframeContent={setIframeContent}/>} />
                <Route path="/live" element={<Live setOpenIframe={setOpenIframe} setIframeContent={setIframeContent}/>} />
                <Route path="/game" element={<Game setOpenIframe={setOpenIframe} setIframeContent={setIframeContent}/>} />
                <Route path="/fish" element={<Fish setOpenIframe={setOpenIframe} setIframeContent={setIframeContent}/>} />
                <Route path="/ball" element={<Ball setOpenIframe={setOpenIframe} setIframeContent={setIframeContent}/>} />
                <Route path="/circle" element={<Circle setOpenIframe={setOpenIframe}/>} />
            </Routes>
            {openIframe == true ? <Iframe miniIframe={miniIframe} iframeContent={iframeContent}/> : null}
            {miniIframe == true ? <MiniIframe setMiniIframe={setMiniIframe} iframeContent={iframeContent}/> : null}
        </HashRouter>
        </>
    )
}

export default Index;
