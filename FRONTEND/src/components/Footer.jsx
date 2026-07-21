export default function Footer({ appname, version }) {
    return (
        <footer className="footer">
            <div className="footer-content">
                <p>&copy; {new Date().getFullYear()} {appname}. Tous droits réservés.</p>
                <p>{version}</p>
            </div>
        </footer>
    )
}