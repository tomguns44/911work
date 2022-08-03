import React, { useEffect,useState } from 'react';



const UseRWD = () =>{
    const [device,setDevice] = useState('mobile');

    const handleRWD=()=>{
        if(window.innerWidth > 640)
            setDevice("PC");
        else
            setDevice("mobile");
    }

    useEffect(()=>{
        window.addEventListener('resize',handleRWD);
        handleRWD()
        return(()=>{
            window.removeEventListener('resize',handleRWD)
        })
    },[])

    return device;
    
}

export default UseRWD;
