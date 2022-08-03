import React, { useState } from 'react';
import AE from '../../../images/logo/AE.png'
import SEXYBCRT from '../../../images/logo/SEXYBCRT.png'
import VENUS from '../../../images/logo/VENUS.png'

const GameSelect = () =>{
    
    const [select,setSelect] = useState([
        // {
        //     img:JILI,
        //     title:"JILI"
        // },
        {
            img:AE,
            title:"AE"
        },
        // {
        //     img:JDB,
        //     title:"JDB"
        // },
        {
            img:SEXYBCRT,
            title:"SEXY"
        },
        {
            img:VENUS,
            title:"VENUS"
        },
    ])


    return(
        <section className='p-3' style={{background:"#0c151d"}}>
            <div className='mx-auto grid grid-cols-5 gap-4' style={{maxWidth:"550px"}}>
                <div>
                    <img src={SEXYBCRT}/>
                    <p className='text-center text-white text-2xl'>AE</p>
                </div>
            </div>
        </section>
    )
}

export default GameSelect;
