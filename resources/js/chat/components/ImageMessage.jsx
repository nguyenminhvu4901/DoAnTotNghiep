import { Box, Modal, Fade, styled } from '@mui/material';
import * as React from 'react';
import Backdrop from '@mui/material/Backdrop';

const Container = styled(Box)({
    position: 'relative',
});

const ImageBox = styled('img')({
    maxWidth: '250px',
    maxHeight: '250px',
    cursor: 'pointer',
});

const ZoomImage = styled(Box)({
    position: 'absolute',
    top: '50%',
    left: '50%',
    transform: 'translate(-50%, -50%)',
    width: '600px',
    border: '1px solid #000',
    boxShadow: 24,
    padding: '2px',
});

function ImageMessage({ url }) {
    const [open, setOpen] = React.useState(false);
    const handleOpen = () => setOpen(true);
    const handleClose = () => setOpen(false);

    return (
        <Container>
            <ImageBox src={url} onClick={handleOpen} />
            {open && (
                <Modal
                    aria-labelledby="transition-modal-title"
                    aria-describedby="transition-modal-description"
                    open={open}
                    onClose={handleClose}
                    closeAfterTransition
                    disableScrollLock
                    slots={{ backdrop: Backdrop }}
                    slotProps={{
                        backdrop: {
                            timeout: 500,
                        },
                    }}
                >
                    <Fade in={open}>
                        <ZoomImage>
                            <img src={url} />
                        </ZoomImage>
                    </Fade>
                </Modal>
            )}
        </Container>
    );
}

export default ImageMessage;
