<form id="contactForm" action="{{ route('contacts.store') }}" method="POST">
    @csrf
    @if(isset($property))
    <input type="hidden" name="property_id" value="{{ $property->id }}">
    @endif
    <div class="row g-3">
        <div class="col-12">
            <div class="form-floating">
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" autocomplete="off" required />
                <label for="name">Name</label>
            </div>
        </div>

        <div class="col-12">
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" autocomplete="off" required />
                <label for="email">Email</label>
            </div>
        </div>

        <div class="col-12">
            <div class="form-floating">
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone Number" maxlength="10" autocomplete="off" />
                <label for="phone">Phone Number</label>
            </div>
        </div>
        <div class="col-12">
            <div class="form-floating">
                <textarea
                    class="form-control"
                    placeholder="Leave a message here"
                    id="message"
                    name="message"
                    style="height: 150px"
                    autocomplete="off"></textarea>
                <label for="message">Message</label>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-end">
            <input type="submit" class="btn btn-primary" value="Send Message" />
        </div>
    </div>
</form>