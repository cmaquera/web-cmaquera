                          <div class="form-group">
                            <label>Titulo del post</label>
                            <input class="form-control" type="text" placeholder="Titulo..." name="title">
                          </div>
                          <div class="form-group">
                            <label>Contenido del post</label>
                            <div class="{{ $editable }}" id="content"></div>
                            <input type="hidden" name="content"/>
                          </div>
                          <div class="form-group">
                            <label>Tag del post</label>
                            <select class="form-control" name="tag_id">
                            </select>
                          </div>
                          <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="published"> Publicar ahora del post
                              </label>
                            </div>
                          </div>
                          