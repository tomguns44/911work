import React, { useState } from 'react';
import Game from './Game';
import Gamelist from './Gamelist';
import {AiOutlineStar} from "react-icons/ai";
import {TbGasStation} from "react-icons/tb";
import {GiGamepad} from "react-icons/gi"


const Home =({setOpenIframe,setIframeContent}) =>{

    const [gamelist1,setGameList1] = useState([
        {
            type:"JILI",
            title:"Bingo Carnaval",
            image:"https://images-1304591867.cos.ap-bangkok.myqcloud.com/gameIcon/JILI/BingoCarnaval.webp",
            fix:1,

        },
        {
            type:"JILI",
            title:"Mayan Empire",
            image:"https://images-1304591867.cos.ap-bangkok.myqcloud.com/gameIcon/JILI/MayanEmpire.webp"
        },
        {
            type:"JILI",
            title:"Sic Bo",
            image:"https://images-1304591867.cos.ap-bangkok.myqcloud.com/gameIcon/JILI/SicBo.webp"
        },
        {
            type:"FACHAI",
            title:"Chinese New Year 2",
            image:"https://www.mwbet188.com/theme/images/gameIcon/FACHAI/ChineseNewYear2.webp"
        },
        {
            type:"JILI",
            title:"Gold Rush",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/GoldRush.webp"
        },
        {
            type:"JILI",
            title:"Happy Taxi",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/HappyTaxi.webp"
        },
        {
            type:"MIMI",
            title:"Joker's Luck",
            image:"https://www.mwbet188.com/theme/images/gameIcon/MIMI/Jokers_Luck.webp"
        },
        {
            type:"MIMI",
            title:"Gods of Olympus",
            image:"https://www.mwbet188.com/theme/images/gameIcon/MIMI/Gods_of_Olympus.webp"
        },
        {
            type:"MIMI",
            title:"Minion Rush",
            image:"https://www.mwbet188.com/theme/images/gameIcon/MIMI/Minion_Rush.webp"
        },
        {
            type:"OG",
            title:"The Game",
            image:"https://www.mwbet188.com/theme/images/gameIcon/OG/The_Game.webp"
        },
        {
            type:"MWSLOT",
            title:"Glory of Rome",
            image:"https://www.mwbet188.com/theme/images/gameIcon/MWSLOT/GloryofRome.webp"
        },
        {
            type:"MWSLOT",
            title:"Pirate Treasure",
            image:"https://www.mwbet188.com/theme/images/gameIcon/MWSLOT/PirateTreasure.webp"
        },
        {
            type:"YB",
            title:"Money Bingo",
            image:"https://www.mwbet188.com/theme/images/gameIcon/YB/MoneyBingo.webp"
        },
        {
            type:"AESLOT",
            title:"Beat The Boss",
            image:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/BEAT_THE_BOSS.webp"
        },
        {
            type:"AESLOT",
            title:"EZ2 Lotto",
            image:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/EZ2_LOTTO.webp"
        },
        {
            type:"KINGMAKER",
            title:"Kingmaker Virtual Horse Racing",
            image:"https://www.mwbet188.com/theme/images/gameIcon/KINGMAKER/KingmakerVirtualHorseRacing.webp"
        },
        {
            type:"KINGMAKER",
            title:"B5 Card Poker",
            image:"https://www.mwbet188.com/theme/images/gameIcon/KINGMAKER/5CardPoker.webp"
        },
    ]);
    const [gamelist2,setGameList2] = useState([
        {
            type:"JILI",
            title:"Super Ace",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/SuperAce.webp"    
        },
        {
            type:"JILI",
            title:"Golden Empire",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/GoldenEmpire.webp"    
        },
        {
            type:"JILI",
            title:"Fortune Gems",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/FortuneGems.webp"    
        },
        {
            type:"JILI",
            title:"Money Coming",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/MoneyComing.webp"    
        },
        {
            type:"JILI",
            title:"Boxing King",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/BoxingKing.webp"    
        },
        {
            type:"FACHAI",
            title:"Chinese New Year",
            image:"https://www.mwbet188.com/theme/images/gameIcon/FACHAI/ChineseNewYear.webp"    
        },
        {
            type:"JILI",
            title:"Mega Ace",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/MegaAce.webp"    
        },
        {
            type:"JILI",
            title:"Crazy Seven",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/CrazySeven.webp"    
        },
        {
            type:"FACHAI",
            title:"Cowboys",
            image:"https://www.mwbet188.com/theme/images/gameIcon/FACHAI/Cowboys.webp"    
        },
        {
            type:"FACHAI",
            title:"Lucky Fortunes",
            image:"https://www.mwbet188.com/theme/images/gameIcon/FACHAI/LuckyFortunes.webp"    
        },
        {
            type:"FACHAI",
            title:"Night Market",
            image:"https://www.mwbet188.com/theme/images/gameIcon/FACHAI/NightMarket.webp"    
        },
        {
            type:"JILI",
            title:"Mayan Empire",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/MayanEmpire.webp"    
        },
        {
            type:"JILI",
            title:"Charge Buffalo",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/ChargeBuffalo.webp"    
        },
        {
            type:"JILI",
            title:"Alibaba",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/Alibaba.webp"    
        },
        {
            type:"FACHAI",
            title:"Chinese New Year 2",
            image:"https://www.mwbet188.com/theme/images/gameIcon/FACHAI/ChineseNewYear2.webp"    
        },
        {
            type:"JILI",
            title:"Shanghai Beauty",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/ShanghaiBeauty.webp"    
        },
        {
            type:"JILI",
            title:"Bubble Beauty",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/BubbleBeauty.webp"    
        },
        {
            type:"FACHAI",
            title:"Treasure Cruise",
            image:"https://www.mwbet188.com/theme/images/gameIcon/FACHAI/TreasureCruise.webp"    
        },

    ]);
    const [gamelist3,setGameList3] = useState([
        {
            type:"JILI",
            title:"Bonus Bingo",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/BonusBingo.gif"    
        },
        {
            type:"JILI",
            title:"Super Bingo",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/SuperBingo.webp"    
        },
        {
            type:"YB",
            title:"Open Sesame",
            image:"https://www.mwbet188.com/theme/images/gameIcon/YB/OpenSesame.webp"    
        },
        {
            type:"JILI",
            title:"Bingo Carnaval",
            image:"https://images-1304591867.cos.ap-bangkok.myqcloud.com/gameIcon/JILI/BingoCarnaval.webp"    
        },
        {
            type:"YB",
            title:"Beasty Bingo",
            image:"https://www.mwbet188.com/theme/images/gameIcon/YB/BeastyBingo.webp"    
        },
        {
            type:"JILI",
            title:"iRich Bingo",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/iRichBingo.webp"    
        },
        {
            type:"YB",
            title:"Money Bingo",
            image:"https://www.mwbet188.com/theme/images/gameIcon/YB/MoneyBingo.webp"    
        },
        {
            type:"YB",
            title:"Bingo Bonanza",
            image:"https://www.mwbet188.com/theme/images/gameIcon/YB/BingoBonanza.webp"    
        },
        {
            type:"JILI",
            title:"Bingo Empire",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/BingoEmpire.webp"    
        },
        {
            type:"YB",
            title:"Bingo Bingo",
            image:"https://www.mwbet188.com/theme/images/gameIcon/YB/BingoBingo.webp"    
        },
        {
            type:"JILI",
            title:"Crazy Hunter",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/CrazyHunter.webp"    
        },
        {
            type:"YB",
            title:"Atlantis",
            image:"https://www.mwbet188.com/theme/images/gameIcon/YB/Atlantis.webp"    
        },
        {
            type:"FACHAI",
            title:"Money Tree Dozer",
            image:"https://www.mwbet188.com/theme/images/gameIcon/FACHAI/MoneyTreeDozer.webp"    
        },
        {
            type:"JILI",
            title:"Secret Treasure",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/SecretTreasure.webp"    
        },
        {
            type:"KINGMAKER",
            title:"Minesweeper",
            image:"https://www.mwbet188.com/theme/images/gameIcon/KINGMAKER/minesweeper.webp"    
        },
        {
            type:"YB",
            title:"Win Cai Shen",
            image:"https://www.mwbet188.com/theme/images/gameIcon/YB/WinCaiShen.webp"    
        },
        {
            type:"JILI",
            title:"Fortune Bingo",
            image:"https://www.mwbet188.com/theme/images/gameIcon/JILI/FortuneBingo.webp"    
        },
        {
            type:"AESLOT",
            title:"E-Bingo",
            image:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/E_BINGO.webp"    
        },
    ]);

    return(
        <>
        <Gamelist title="New Game" titleIcon={<AiOutlineStar />} background="https://www.mwbet188.com/src-gameHall/gameHall-img/layout/section-NEW-bg.jpg" props={gamelist1} openGame={setOpenIframe} setIframeContent={setIframeContent}/>
        <Gamelist title="SLOT Game" titleIcon={<TbGasStation />} background="https://www.mwbet188.com/src-gameHall/gameHall-img/layout/section-SLOT-bg.jpg" props={gamelist2}/>
        <Gamelist title="ARCADE" titleIcon={<GiGamepad />} background="https://www.mwbet188.com/src-gameHall/gameHall-img/layout/section-ARCADE-bg.jpg" props={gamelist3}/>
        </>
    )
}
export default Home;
