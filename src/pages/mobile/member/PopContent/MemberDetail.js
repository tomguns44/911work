import React, { Component } from 'react';

const MemberDetail = () =>{
    return(
        <>
        <section className='w-100'>
            <div className='grid py-1 grid-cols-3 mb-3 border-b'>
                <p className='mr-3 text-amber-500 col-span-1'>Login Name</p>
                <p className='col-span-2 text-black'>demo</p>
            </div>
            <div className='grid py-1 grid-cols-3 mb-3 border-b'>
                <p className='mr-3 text-amber-500 col-span-1'>Name</p>
                <p className='col-span-2 text-black'>Testing</p>
            </div>
            <div className='grid py-1 grid-cols-3 mb-3 border-b'>
                <p className='mr-3 text-amber-500 col-span-1'>Balance</p>
                <p className='col-span-2 text-black'>9,212.54</p>
            </div>
        </section>
        </>
    )
}

export default MemberDetail;
