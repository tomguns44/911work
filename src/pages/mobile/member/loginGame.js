import React, { useState } from 'react';

const LoginGame =({setOpen}) =>{

    const [data,setData] = useState({
        LoginName:"",
        Password:"",
    });

    function handleChange(e){
       setData({...data,[e.target.name]:e.target.value})
    }


    function handleSubmit(e){
        e.preventDefault();
        const LoginName = document.getElementById('LoginName').value
        const Password = document.getElementById('Password').value
        /* const sendData={
            LoginName:data.LoginName,
            Password:data.Password,
        }
        console.log(sendData) */
        fetch('./API/member.php', { 
        method: 'POST',
        headers: {
        'Content-Type': 'application/json'
        },
        body: JSON.stringify({
        'LoginName': LoginName,
        'Password': Password,
        })
        })
        .then(
        response => response.text()
        )
        .then((data) => {
            var obj = JSON.parse(data);
            if (obj.code=="Ok"){
                if (window.sessionStorage.getItem('sess_911betnet_xyz')!==null) {
                    window.sessionStorage.removeItem();
                }
                window.sessionStorage.setItem('sess_911betnet_xyz',obj.token);
            }else{
            }
        console.log(data);
        });
    }
    
    return(
        <>
            <form className='flex flex-col items-center' onSubmit={handleSubmit}>
                <div className='flex flex-col items-start justify-center w-56 mb-5'>
                    <label className='mb-2'>Login Name</label>
                    <input id="LoginName" name="LoginName" className='border p-1 w-full' type="text" placeholder='Login Name' onChange={handleChange} value={data.LoginName}/>
                </div>
                <div className='flex flex-col items-start justify-center w-56 mb-10'>
                    <label className='mb-2'>Password</label>
                    <input id="Password" name="Password" className='border p-1 w-full' type="password" placeholder='Password' onChange={handleChange} value={data.password}/>
                </div>
            <button type="submit" className='w-56 btn rounded-full p-2 bg-cyan-800 text-white mb-5' >Login.</button>
            <button className='w-56 btn rounded-full p-2 bg-green-400 text-white' onClick={()=>setOpen(true)}>Register</button>
            </form>


        
        </>

    )
}

export default LoginGame;
