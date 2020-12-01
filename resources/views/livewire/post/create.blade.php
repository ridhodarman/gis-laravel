<div style="padding: 50px;">
    <form wire:submit.prevent="store">
        <div class="form-group">
          <label for="exampleInputEmail1">Model Bangunan</label>
          <input type="text" class="form-control @error('name_of_model') is-invalid @enderror" 
            id="exampleInputEmail1" name="name" wire:model="name_of_model">
          @error('name_of_model') <span class="error">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
