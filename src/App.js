import logo from './logo.svg';
import Index from './pages/mobile/index';
import Login from './pages/mobile/member/login';
import IndexPC from './pages/pc/index';
import useRWD from './pages/globalComponents/useRWD';

function App() {

  const device = useRWD();

  return (
    <div className="App">
       <Login/>
       {/* device == "PC" ? <IndexPC/>:<Index/> */} 
    </div>
  );
}

export default App;
