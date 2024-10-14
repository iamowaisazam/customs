<div class="display-table">
    <div class="display-table-cell footer-newsletter">
    <form id="newsletter-form" action="#" method="post">
        @csrf
        
        <p>Sign up for newsletter to know our latest news and offers.</p>
        <div class="input-group">
            <input type="email" class="input-group__field newsletter__input" name="EMAIL" value="" placeholder="Email address" required />
            <span class="input-group__btn">
                <button type="submit" class="btn newsletter__submit" name="commit" id="Subscribe"><span class="newsletter__submit-text--large">Sign Up</span></button>
            </span>
        </div>
    </form>
    </div>
</div>