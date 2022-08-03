import React, { Component } from 'react';

const Iframe = ({miniIframe,iframeContent}) =>{
    return(
        <>
            <iframe className={`fixed left-0 w-full ${miniIframe == true ? "invisible":"visible"}`} src="https://www.youtube.com/embed/DRB0Z34nwho" title="W3Schools Free Online Web Tutorials" style={{height:"calc( 100% - 50px)",top:"50px",zIndex:"100"}}>

            </iframe>
            
        </>
    )
}

export default Iframe;
