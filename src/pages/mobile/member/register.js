import React, { useState } from 'react';

const Register = ({setOpen}) =>{

    const [data,setData] = useState({
        LoginName:"",
        Password:"",
        passwordagain:"",
    });

    function handleChange(e){
       setData({...data,[e.target.name]:e.target.value})
    }


    function handleSubmit(e){
        e.preventDefault();
        const sendData={
            LoginName:data.LoginName,
            Password:data.Password,
            passwordagain:data.passwordagain
        }
        console.log(sendData);
    }

    return(
        <form className='flex flex-col items-center' onSubmit={handleSubmit}>
            <div className='flex flex-col items-start justify-center w-56 mb-5'>
                <label className='mb-2'>Login Name</label>
                <input name="LoginName" className='border p-1 w-full' type="text" placeholder='Login Name' onChange={handleChange} value={data.LoginName}/>
            </div>
            <div className='flex flex-col items-start justify-center w-56 mb-5'>
                <label className='mb-2'>Password</label>
                <input name="Password" className='border p-1 w-full' type="text" placeholder='Login Name' onChange={handleChange} value={data.Password}/>
            </div>
            <div className='flex flex-col items-start justify-center w-56 mb-10'>
                <label className='mb-2'>Enter the password again</label>
                <input name="passwordagain" className='border p-1 w-full' type="password" placeholder='Enter the password again' onChange={handleChange} value={data.passwordagain}/>
            </div>

            <button className='w-56 btn rounded-full p-2 bg-cyan-800 text-white mb-5' type="submit">Confirm</button>
            <button className='w-56 btn rounded-full p-2 bg-red-600	 text-white' onClick={()=>setOpen(false)}>Back</button>
        </form>
)
}

export default Register;
