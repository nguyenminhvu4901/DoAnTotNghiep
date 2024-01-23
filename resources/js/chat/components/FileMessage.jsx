import FileDownloadOutlinedIcon from '@mui/icons-material/FileDownloadOutlined';
import TopicOutlinedIcon from '@mui/icons-material/TopicOutlined';
import { Box, styled } from '@mui/material';

const Container = styled(Box)({
    width: '100%',
    display: 'flex',
    flexDirection: 'row',
    flexWrap: 'nowrap',
    alignContent: 'center',
    justifyContent: 'space-between',
    alignItems: 'center',
    '& .icon-file, .icon-download': {
        width: '25px',
        height: '25px',
    },
});

const FileName = styled('p')({
    padding: '0 2px 0 4px',
    color: 'black',
    margin: 0,
    overflow: 'hidden',
    whiteSpace: 'nowrap',
    textOverflow: 'ellipsis',
    display: 'block',
    maxWidth: '95%',
    WebkitBoxOrient: 'vertical',
    WebkitLineClamp: 1,
});

function FileMessage({ file }) {
    return (
        <Container>
            <TopicOutlinedIcon className="icon-file" />
            <FileName className="file">{file}</FileName>
            <FileDownloadOutlinedIcon className="icon-download" />
        </Container>
    );
}

export default FileMessage;
