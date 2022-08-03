import React, { useState } from 'react';
import Fix from './Fix';
import { motion } from 'framer-motion';

const RightbarGamelist = ({props,giveClass}) =>{

    const [getArray,setGetArray] = useState(props)

    return(
        <>
            <section className={`py-2 grid grid-cols-3 gap-3 overflow-y-scroll my-2 ${giveClass == true ?"Parallel":""}`}>
            {
            getArray.map((item,key)=>{
                return(
                        <motion.div 
                        initial={{opacity:0}}
                        animate={{opacity:1}}
                        transition={{duration:0.3,delay:`0.${key}`}}    
                        className='text-white relative' 
                        key={key}
                        >
                            <img src={item.img} />
                            <p className='text-center text-xs'>{item.title}</p>
                            {item.fix == 1 ? <Fix /> : null}
                        </motion.div>

                        )
                })
            }
            </section>
                </>
)
}
export default RightbarGamelist