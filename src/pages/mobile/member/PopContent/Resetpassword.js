import React, { useState } from 'react';

const Forgetpassword = () =>{
    const [data,setData] = useState({
        OldPassword:"",
        NewPassword:"",
        NewPasswordAgain:"",
    });

    function handleChange(e){
       setData({...data,[e.target.name]:e.target.value})
    }


    function handleSubmit(e){
        e.preventDefault();
        const sendData={
            OldPassword:data.OldPassword,
            NewPassword:data.NewPassword,
            NewPasswordAgain:data.NewPasswordAgain
        }
        console.log(sendData)
    }
    
    return(
        <>
        <section className='w-100'>
            <form className='flex flex-col items-center' onSubmit={handleSubmit}>
                <div className='flex flex-col items-start justify-center w-56 mb-3'>
                        <label className='mb-2'>Old Password</label>
                        <input id="OldPassword" name="OldPassword" className='border p-1 w-full' type="password" placeholder='' onChange={handleChange} value={data.OldPassword}/>
                    </div>
                    <div className='flex flex-col items-start justify-center w-56 mb-3'>
                        <label className='mb-2'>New Password</label>
                        <input id="NewPassword" name="NewPassword" className='border p-1 w-full' type="password" placeholder='' onChange={handleChange} value={data.NewPassword}/>
                    </div>
                    <div className='flex flex-col items-start justify-center w-56 mb-5'>
                        <label className='mb-2'>New Password Again</label>
                        <input id="NewPasswordAgain" name="NewPasswordAgain" className='border p-1 w-full' type="password" placeholder='' onChange={handleChange} value={data.NewPasswordAgain}/>
                    </div>
                <button type="submit" className='w-56 btn rounded-full p-2 bg-cyan-800 text-white mb-5'>Submit</button>
            </form>
        </section>
        </>
    )
}

export default Forgetpassword;
