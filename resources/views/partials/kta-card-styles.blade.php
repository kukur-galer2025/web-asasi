{{-- Gaya kartu KTA resmi (dipakai dashboard anggota & showcase beranda). Aman di-include berkali-kali. --}}
@once
<style>
.asasi-card-wrap {
    --midnight: #061b2c;
    --navy: #092941;
    --slate: #15374d;
    --champagne: #e6c891;
    --gold: #bc965b;
    --ivory: #f9f6ee;
    --muted: #acbcc5;
    --card-ratio: 85.6 / 54;
}
.asasi-card {
    position: relative;
    isolation: isolate;
    overflow: hidden;
    aspect-ratio: var(--card-ratio);
    border-radius: 18px;
    background: radial-gradient(circle at 95% 0%, rgba(242,214,161,.13) 0%, transparent 36%),
                radial-gradient(circle at 0% 100%, rgba(95,163,195,.10) 0%, transparent 46%),
                linear-gradient(128deg, #061b2c 0%, #092941 64%, #19465d 100%);
    color: var(--ivory);
    box-shadow: 0 20px 45px rgba(6,27,44,.28), 0 6px 16px rgba(6,27,44,.18);
    box-sizing: border-box;
}
.asasi-card .card-border-frame {
    position: absolute;
    top: 1.5px;
    left: 1.5px;
    right: 1.5px;
    bottom: 1.5px;
    border: 1.5px solid rgba(245,224,178,.55);
    border-radius: 16.5px;
    pointer-events: none;
    z-index: 40;
    box-sizing: border-box;
}
.asasi-card .card-inner {
    position: relative;
    height: 100%;
    padding: 4% 5.5%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.asasi-card .top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}
.asasi-card .brand {
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 0;
}
.asasi-card .brand img {
    display: block;
    width: 40px;
    height: 26px;
    object-fit: contain;
}
.asasi-card .brandline {
    width: 1px;
    height: 24px;
    background: rgba(230,200,145,0.7);
    flex: none;
}
.asasi-card .brand-title {
    font-family: Georgia, serif;
    letter-spacing: .14em;
    font-weight: 700;
    font-size: 14px;
    line-height: 1;
    color: #f9f6ee;
}
.asasi-card .brand-sub {
    font-size: 5px;
    letter-spacing: .09em;
    color: #b7cbd3;
    margin-top: 2.5px;
    line-height: 1.25;
    text-transform: uppercase;
}
.asasi-card .tier {
    border: 1px solid rgba(230,200,145,.48);
    border-radius: 100px;
    padding: 2.5px 6.5px;
    color: var(--champagne);
    font-size: 6.5px;
    font-weight: 800;
    letter-spacing: .14em;
    white-space: nowrap;
    text-transform: uppercase;
}
.asasi-card .hairline {
    height: 1px;
    background: rgba(230,200,145,.45);
    margin: 2% 0 2.5% 0;
}
.asasi-card .front-content {
    display: grid;
    grid-template-columns: 22% 1fr;
    gap: 4%;
    flex: 1;
    min-height: 0;
    align-items: flex-start;
}
.asasi-card .portrait {
    width: 100%;
    aspect-ratio: 3/4;
    background: #15374d;
    border-radius: 7px;
    padding: 2px;
    border: 1px solid rgba(233,204,143,.7);
    box-shadow: 0 4px 10px rgba(0,0,0,0.35);
}
.asasi-card .portrait .portrait-inner {
    width: 100%;
    height: 100%;
    background: #15374d;
    border-radius: 5px;
    display: grid;
    place-items: center;
    overflow: hidden;
}
.asasi-card .label {
    color: #aebfca;
    font-size: 6.5px;
    letter-spacing: .12em;
    text-transform: uppercase;
    font-weight: 800;
}
.asasi-card .member-name {
    margin: 1px 0 2px;
    font: bold clamp(11px, 1.3vw, 15px)/1.2 Georgia, serif;
    color: var(--ivory);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.asasi-card .status {
    color: var(--champagne);
    text-transform: uppercase;
    letter-spacing: .12em;
    font-size: 7px;
    font-weight: 750;
    margin-bottom: 2px;
}
.asasi-card .details {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2px 8px;
    margin-top: 3px;
}
.asasi-card .details strong {
    display: block;
    font-size: 8.5px;
    letter-spacing: .02em;
    margin-top: 0.5px;
    color: #f2f1ec;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.asasi-card .bottom {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 8px;
    margin-top: auto;
    padding-top: 3px;
    border-top: 1px solid rgba(230,200,145,0.25);
}
.asasi-card .bottom small {
    font-size: 6px;
    color: #a9bfcb;
    letter-spacing: .08em;
}
.asasi-card .bottom .seal {
    color: var(--champagne);
    font: italic 10.5px Georgia, serif;
    white-space: nowrap;
}

/* Back Card */
.asasi-card.back .card-inner {
    padding: 6.5% 7.5%;
}
.asasi-card.back .back-kicker {
    color: var(--champagne);
    letter-spacing: .2em;
    font-size: 8px;
    font-weight: 800;
    text-transform: uppercase;
}
.asasi-card.back h2 {
    margin: 7px 0 5px;
    font: 500 clamp(13px, 1.45vw, 18px)/1.3 Georgia, serif;
    color: #f9f6ee;
}
.asasi-card.back p {
    font-size: 8px;
    line-height: 1.5;
    color: #b7c7d0;
    margin: 2px 0;
}
.asasi-card.back .back-lower {
    display: flex;
    align-items: end;
    justify-content: space-between;
    gap: 12px;
    margin-top: auto;
    padding-top: 6px;
}
.asasi-card.back .barcode-wrap {
    background: #f8f7f1;
    border-radius: 6px;
    padding: 8px 10px 6px;
    width: 55%;
}
.asasi-card.back .barcode {
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}
.asasi-card.back .barcode-label {
    display: block;
    text-align: center;
    color: #3b4a54;
    margin-top: 4px;
    font-size: 7px;
    letter-spacing: .14em;
    font-weight: bold;
}
.asasi-card.back .verification {
    text-align: right;
}
.asasi-card.back .verification .caption {
    color: var(--champagne);
    font-size: 7px;
    letter-spacing: .14em;
    font-weight: 700;
    text-transform: uppercase;
}
.asasi-card.back .verification strong {
    display: block;
    font-size: 11px;
    margin: 3px 0 1px;
    letter-spacing: .02em;
    color: #f9f6ee;
}
.asasi-card.back .verification small {
    color: #a8bbc6;
    font-size: 7px;
}
</style>
@endonce
