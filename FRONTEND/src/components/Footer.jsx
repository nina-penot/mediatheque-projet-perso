export default function Footer(appname, version) {
    return (
        <footer class="footer">
            <div class="footer-content">
                <p>&copy; {new Date().getFullYear()} {appname}. Tous droits réservés.</p>
                <p>{version}</p>
            </div>
        </footer>
    )
}