import React, { useState } from 'react';
import RowGameTItle from '../../mobile/components/rowGameTItle';
import RowGame from '../../mobile/components/rowGame';
import styled from 'styled-components';
import images1 from '../../../images/gameIcon/en/SPORTS/sports_wos.png'
import newIcon from '../../../images/gameType/icon-new.svg'
import MoreGame from '../../mobile/components/moreGame';
const Section = styled.div`
    .title{
        color:#f4e0bd;
        *{
            font-size:25px;
        }
    }
`

const Newgame = ({moreGame,setMoreClick}) =>{
    const [gamelist1,setGameList1] = useState([
        {
            type:"JILI",
            title:"Bingo Carnaval",
            images:"https://images-1304591867.cos.ap-bangkok.myqcloud.com/gameIcon/JILI/BingoCarnaval.webp",
            fix:1,
            mask:1,
        },
        {
            type:"JILI",
            title:"Mayan Empire",
            images:"https://images-1304591867.cos.ap-bangkok.myqcloud.com/gameIcon/JILI/MayanEmpire.webp",
            mask:1,
        },
        {
            type:"JILI",
            title:"Sic Bo",
            images:"https://images-1304591867.cos.ap-bangkok.myqcloud.com/gameIcon/JILI/SicBo.webp",
            mask:1,
        },
        {
            type:"FACHAI",
            title:"Chinese New Year 2",
            images:"https://www.mwbet188.com/theme/images/gameIcon/FACHAI/ChineseNewYear2.webp",
            mask:1,
        },
        {
            type:"JILI",
            title:"Gold Rush",
            images:"https://www.mwbet188.com/theme/images/gameIcon/JILI/GoldRush.webp",
            mask:1,
        },
        {
            type:"JILI",
            title:"Happy Taxi",
            images:"https://www.mwbet188.com/theme/images/gameIcon/JILI/HappyTaxi.webp",
            mask:1,
        },
        {
            type:"MIMI",
            title:"Joker's Luck",
            images:"https://www.mwbet188.com/theme/images/gameIcon/MIMI/Jokers_Luck.webp",
            mask:1,
        },
        {
            type:"MIMI",
            title:"Gods of Olympus",
            images:"https://www.mwbet188.com/theme/images/gameIcon/MIMI/Gods_of_Olympus.webp",
            mask:1,
        },
        {
            type:"MIMI",
            title:"Minion Rush",
            images:"https://www.mwbet188.com/theme/images/gameIcon/MIMI/Minion_Rush.webp",
            mask:1,
        },
        {
            type:"OG",
            title:"The Game",
            images:"https://www.mwbet188.com/theme/images/gameIcon/OG/The_Game.webp",
            mask:1,
        },
        {
            type:"MWSLOT",
            title:"Glory of Rome",
            images:"https://www.mwbet188.com/theme/images/gameIcon/MWSLOT/GloryofRome.webp",
            mask:1,
        },
        {
            type:"MWSLOT",
            title:"Pirate Treasure",
            images:"https://www.mwbet188.com/theme/images/gameIcon/MWSLOT/PirateTreasure.webp",
            mask:1,
        },
        {
            type:"YB",
            title:"Money Bingo",
            images:"https://www.mwbet188.com/theme/images/gameIcon/YB/MoneyBingo.webp",
            mask:1,
        },
        {
            type:"AESLOT",
            title:"Beat The Boss",
            images:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/BEAT_THE_BOSS.webp",
            mask:1,
        },
        {
            type:"AESLOT",
            title:"EZ2 Lotto",
            images:"https://www.mwbet188.com/theme/images/gameIcon/AESLOT/EZ2_LOTTO.webp",
            mask:1,
        },
        {
            type:"KINGMAKER",
            title:"Kingmaker Virtual Horse Racing",
            images:"https://www.mwbet188.com/theme/images/gameIcon/KINGMAKER/KingmakerVirtualHorseRacing.webp",
            mask:1,
        },
        {
            type:"KINGMAKER",
            title:"B5 Card Poker",
            images:"https://www.mwbet188.com/theme/images/gameIcon/KINGMAKER/5CardPoker.webp",
            mask:1,
        },
    ]);

    return(
        <>
        <Section className="flex flex-col mb-6">
            <RowGameTItle icon={newIcon} title="NewGames"/>
            <ul className='grid grid-cols-7 gap-4 w-full'>
                <RowGame game={gamelist1} limit="14"/>
            </ul>
            { moreGame == 1 ?
                <MoreGame link="Slots" setMoreClick={setMoreClick}/>:null}
        </Section>
        </> 
    )
}

export default Newgame;
