import React, { useState } from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { Navigation, Pagination, Scrollbar, A11y ,EffectFade,Autoplay,loop} from 'swiper';
import styled from 'styled-components';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';
import 'swiper/css/effect-fade';
import 'swiper/css/autoplay'



const Carousel = ({Height,setCarousel}) =>{
    const Container = styled.div`
    padding:.5rem;
    margin-top:155px;
    height:${Height};
    img{
        height:100%;
        max-width:1440px;
    }
`
    const [nowCarousel,setNowCarousel] = useState(
        setCarousel
    )
    return(
        <>
        <Container>
            <Swiper 
            modules={[Pagination]} 
            className="mySwiper h-full w-full"
            loop={true}
            autoplay={{
                delay: 3000,
                disableOnInteraction: false,
            }}
            onSwiper={(swiper) => swiper}
            modules={[Autoplay,EffectFade]}
            effect="fade"    
            >
                    {nowCarousel.map((item,key)=>{
                        return(
                            <SwiperSlide className='rounded-xl' key={key}>
                                <img className='rounded-xl  mx-auto' src={item}/>
                            </SwiperSlide>
                        )
                    })}
            </Swiper>
        </Container>
        </>
    )
}

export default Carousel;
