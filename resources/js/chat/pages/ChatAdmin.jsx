import { Grid, Box, styled, IconButton, TextField, Avatar } from '@mui/material';
import Channels from '../modules/Channels';
import Messages from '../modules/Messages';
import CancelOutlinedIcon from '@mui/icons-material/CancelOutlined';
import FilterNoneOutlinedIcon from '@mui/icons-material/FilterNoneOutlined';
import SendIcon from '@mui/icons-material/Send';
import CloudUploadIcon from '@mui/icons-material/CloudUpload';
import { useEffect, useState } from 'react';
import { red } from '@mui/material/colors';

const Container = styled(Grid)({
    position: 'absolute',
    top: 0,
    right: 0,
    bottom: 0,
    left: 0,
});

const ChannelContainer = styled(Grid)({
    height: '100%',
    overflowY: 'scroll',
    borderRight: 'solid 1px',
});

const MessageContainer = styled(Grid)({
    height: '100%',
});

const ContentChat = styled(Box)({
    height: '75%',
    backgroundColor: '#9b9b9b',
    padding: '5px 10px',
    overflowY: 'scroll',
});

const FooterContainer = styled(Box)({
    height: '25%',
    width: '100%',
    padding: '10px 15px 5px 15px',
    borderTop: '1px solid',
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'flex-start',
    justifyContent: 'flex-end',
});

const VisuallyHiddenInput = styled('input')({
    clip: 'rect(0 0 0 0)',
    clipPath: 'inset(50%)',
    height: 1,
    overflow: 'hidden',
    position: 'absolute',
    bottom: 0,
    left: 0,
    whiteSpace: 'nowrap',
    width: 1,
});

const ContainerPreview = styled(Box)({
    position: 'relative',
    display: 'inline-block',
    paddingTop: '10px',
    maxWidth: '85%',
    '& .file-name': {
        color: '#000',
        width: '100%',
        overflow: 'hidden',
        textOverflow: 'ellipsis',
        whiteSpace: 'nowrap',
    },
});

const PreviewImage = styled('img')({
    maxHeight: '50px',
    maxWidth: '65px',
});

const RemoveFile = styled(CancelOutlinedIcon)({
    position: 'absolute',
    top: '1%',
    right: '-15%',
    cursor: 'pointer',
});

function ChatAdmin() {
    const [message, setMessage] = useState('');
    const [file, setFile] = useState(null);
    const [imagePreviewUrl, setImagePreviewUrl] = useState(null);
    const [openChat, setOpenChat] = useState(false);

    const handleChangeInput = (e) => {
        setMessage(e.target.value);
    };

    const handleChangeFile = (e) => {
        const file = e.target.files[0];
        setImagePreviewUrl(null);
        setFile(file);

        if (file && file.type.startsWith('image/')) {
            const tempUrl = URL.createObjectURL(file);
            setImagePreviewUrl(tempUrl);
        }
    };

    const handleDeleteFile = () => {
        setFile(null);
        setImagePreviewUrl(null);
    };

    return (
        <Container container>
            <ChannelContainer item xs={3}>
                <Channels />
            </ChannelContainer>
            <MessageContainer item xs={9}>
                <ContentChat>
                    <Messages />
                </ContentChat>
                <FooterContainer id="footer-chat">
                    {file && (
                        <ContainerPreview>
                            {imagePreviewUrl ? (
                                <PreviewImage src={imagePreviewUrl} alt="Preview" />
                            ) : (
                                <p className="file-name">{file.name}</p>
                            )}
                            <RemoveFile sx={{ color: red[500] }} fontSize="small" onClick={handleDeleteFile} />
                        </ContainerPreview>
                    )}

                    <Grid container direction="row" justifyContent="center" alignItems="center">
                        <Grid item xs={10}>
                            <TextField
                                label="Message"
                                variant="outlined"
                                sx={{ width: '100%' }}
                                multiline
                                maxRows={2}
                                value={message}
                                onChange={handleChangeInput}
                            />
                        </Grid>
                        <Grid item xs={2} style={{ textAlign: 'center' }}>
                            <IconButton component="label">
                                <CloudUploadIcon />
                                <VisuallyHiddenInput type="file" onChange={handleChangeFile} />
                            </IconButton>
                            <IconButton color="info" disabled={!message && !file}>
                                <SendIcon />
                            </IconButton>
                        </Grid>
                    </Grid>
                </FooterContainer>
            </MessageContainer>
        </Container>
    );
}

export default ChatAdmin;
