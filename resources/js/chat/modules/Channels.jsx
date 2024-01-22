import { Box, styled } from '@mui/material';
import Channel from '../components/Channel';

const Container = styled(Box)({
    width: '100%',
    height: '100%',
    overflowY: 'scroll',
    overflowX: 'hidden',
});

function Channels() {
    const channels = [
        { id: 1, name: 'Annie' },
        { id: 2, name: 'Alice' },
        { id: 3, name: 'Bob' },
        { id: 4, name: 'Charlie' },
        { id: 5, name: 'David' },
        { id: 6, name: 'Eva' },
        { id: 7, name: 'Frank' },
        { id: 8, name: 'Grace' },
        { id: 9, name: 'Henry' },
        { id: 10, name: 'Ivy' },
        { id: 11, name: 'Jack' },
        { id: 12, name: 'Katie' },
        { id: 13, name: 'Leo' },
        { id: 14, name: 'Mia' },
        { id: 15, name: 'Nathan' },
        { id: 16, name: 'Olivia' },
        { id: 17, name: 'Peter' },
        { id: 18, name: 'Quinn' },
        { id: 19, name: 'Rachel' },
        { id: 20, name: 'Sam' },
        { id: 21, name: 'Tina' },
        { id: 22, name: 'Ulysses' },
        { id: 23, name: 'Victoria' },
        { id: 24, name: 'Walter' },
        { id: 25, name: 'Xena' },
        { id: 26, name: 'Yara' },
        { id: 27, name: 'Zane' },
        { id: 28, name: 'Sophie' },
        { id: 29, name: 'Liam' },
        { id: 30, name: 'Emma' },
        { id: 31, name: 'Noah' },
    ];

    return (
        <Container>
            {channels.map((channel) => {
                return <Channel key={channel.id} channel={channel} />;
            })}
        </Container>
    );
}

export default Channels;
